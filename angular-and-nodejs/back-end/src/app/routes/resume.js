const Router = require("express-promise-router");
const db = require("../db");

const router = Router();

module.exports = router;

router.get("/numberofcollaborators", async (req, res, next) => {
  const { rows } = await db.query(
    "select count(*) numero_colaboradores from colaboradores"
  );
  res.send(rows[0]);
});

router.get("/collaboratorsbyroles", async (req, res, next) => {
  const { rows } = await db.query(
    "select * from cargos, lateral(select count(*) quantidade_colaboradores from colaboradores where cargos.id = colaboradores.cargo_id) count order by quantidade_colaboradores desc"
  );
  res.send(rows);
});
