const { Pool } = require("pg");
const enviroment = require("./../../enviroments/enviroment");

const pool = new Pool({
  user: enviroment.user,
  host: enviroment.host,
  database: enviroment.database,
  password: enviroment.password,
  port: enviroment.port,
});

module.exports = {
  query: (text, params, callback) => {
    // const start = Date.now();
    // return pool.query(text, params, (err, res) => {
    //   const duration = Date.now() - start;
    //   console.log("executed query", {
    //     text,
    //     duration,
    //     rows: res && res.rowCount,
    //   });
    //   callback && callback(err, res);
    // });
    return pool.query(text, params, callback);
  },
  getClient: (callback) => {
    pool.connect((err, client, done) => {
      const query = client.query;
      // monkey patch the query method to keep track of the last query executed
      client.query = (...args) => {
        client.lastQuery = args;
        return query.apply(client, args);
      };
      // set a timeout of 5 seconds, after which we will log this client's last query
      const timeout = setTimeout(() => {
        console.error("A client has been checked out for more than 5 seconds!");
        console.error(
          `The last executed query on this client was: ${client.lastQuery}`
        );
      }, 5000);
      const release = (err) => {
        // call the actual 'done' method, returning this client to the pool
        done(err);
        // clear our timeout
        clearTimeout(timeout);
        // set the query method back to its old un-monkey-patched version
        client.query = query;
      };
      callback(err, client, release);
    });
  },
};

pool.on('connect', () => {
  console.log('Database connected with success!');
});

pool.on("error", (err, client) => {
  console.error("Unexpected error on idle client", err);
  process.exit(-1);
});
