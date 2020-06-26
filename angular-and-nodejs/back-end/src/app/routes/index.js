const express = require('express');
const router = express.Router();

const collaborators = require("./collaborators");
const companies = require("./companies");
const roles = require("./roles");
const departments = require("./departments");
const resume = require("./resume");

module.exports = (app) => {
  app.use("/collaborators", collaborators);
  app.use("/companies", companies);
  app.use("/roles", roles);
  app.use("/departments", departments);
  app.use("/resume", resume);
  app.use("/", (req, res, next) => res.send("teste"));
};
