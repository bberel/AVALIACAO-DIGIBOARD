const Router = require("express-promise-router");
const db = require("../db");

const router = Router();

module.exports = router;

router.get("/", async (req, res, next) => {
  const { rows } = await db.query(
    "select * from cargos order by descricao asc"
  );
  res.send(rows);
});

router.get("/:id/occupations", async (req, res, next) => {
  const {
    rows,
  } = await db.query(
    "select * from funcoes where cargo = $1 order by descricao asc",
    [req.params.id]
  );
  res.send(rows);
});
