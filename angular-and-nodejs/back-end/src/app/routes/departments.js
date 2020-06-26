const Router = require("express-promise-router");
const db = require("../db");

const router = Router();

module.exports = router;

router.get("/", async (req, res, next) => {
  const { rows } = await db.query("select * from setores order by nome asc");
  res.send(rows);
});
