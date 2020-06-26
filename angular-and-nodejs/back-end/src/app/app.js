const express = require("express");
var cors = require("cors");
const mountRoutes = require("./routes");

// App
const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cors());

// Create Routes
mountRoutes(app);

module.exports = app;
