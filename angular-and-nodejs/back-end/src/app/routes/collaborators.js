const Router = require("express-promise-router");
const db = require("../db");

const router = Router();

module.exports = router;

router.get("/", async (req, res, next) => {
  let queryString = `select colaboradores.*, to_json(empresa) empresa, to_json(setor) setor, to_json(cargo) cargo, to_json(funcao) funcao from colaboradores,
    lateral(select * from empresas where colaboradores.empresa_id = empresas.id) as empresa,
    lateral(select * from setores where colaboradores.setor_id = setores.id) as setor,
    lateral(select cargos.* from cargos where colaboradores.cargo_id = cargos.id) as cargo,
    lateral(select id, descricao from funcoes where colaboradores.funcao_id = funcoes.id) as funcao
    `;

  // if (req.query) {
  //   const filtro = JSON.parse(req.query.filtro);
  //   queryString += ` where `;

  //   if (filtro.nome) {
  //     queryString += `nome_completo ilike '%${req.body.nome}%'`;
  //   }

  //   console.log(filtro);
  // }

  // console.log(`${queryString} order by nome_completo`);

  const { rows } = await db.query(`${queryString} order by nome_completo`);
  res.send(rows);
});

router.get("/:id", async (req, res, next) => {
  const { rows } = await db.query(
    `select colaboradores.*, colaboradores.data_nascimento::text, to_json(empresa) empresa, to_json(setor) setor, to_json(cargo) cargo, to_json(funcao) funcao from colaboradores,
    lateral(select * from empresas where colaboradores.empresa_id = empresas.id) as empresa,
    lateral(select * from setores where colaboradores.setor_id = setores.id) as setor,
    lateral(select cargos.* from cargos where colaboradores.cargo_id = cargos.id) as cargo,
    lateral(select id, descricao from funcoes where colaboradores.funcao_id = funcoes.id) as funcao
    where colaboradores.id = $1
    `,
    [req.params.id]
  );
  res.send(rows[0]);
});

router.post("/", async (req, res, next) => {
  const queryString =
    "insert into colaboradores(cpf, nome_completo, sexo, nome_mae, nacionalidade, data_nascimento, cargo_id, funcao_id, remuneracao, rg, orgao_emissor, email, telefone, ctps, pis_pasep, empresa_id, setor_id) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17) RETURNING id";
  const params = [
    req.body.cpf,
    req.body.nome_completo,
    req.body.sexo,
    req.body.nome_mae,
    req.body.nacionalidade,
    req.body.data_nascimento,
    req.body.cargo,
    req.body.funcao,
    req.body.remuneracao,
    req.body.rg,
    req.body.orgao_emissor,
    req.body.email,
    req.body.telefone,
    req.body.ctps,
    req.body.pis_pasep,
    req.body.empresa,
    req.body.setor,
  ];
  const { rows } = await db.query(queryString, params);
  res.status(201).send([{ location: "/collaborators/" + rows[0].id }]);
});

router.put("/:id", async (req, res, next) => {
  const queryString =
    "update colaboradores set cpf = $1, nome_completo = $2, sexo = $3, nome_mae = $4, nacionalidade = $5, data_nascimento = $6, cargo_id = $7, funcao_id = $8, remuneracao = $9, rg = $10, orgao_emissor = $11, email = $12, telefone = $13, ctps = $14, pis_pasep = $15, empresa_id = $16, setor_id = $17 where id = $18 returning id";
  const params = [
    req.body.cpf,
    req.body.nome_completo,
    req.body.sexo,
    req.body.nome_mae,
    req.body.nacionalidade,
    req.body.data_nascimento,
    req.body.cargo,
    req.body.funcao,
    req.body.remuneracao,
    req.body.rg,
    req.body.orgao_emissor,
    req.body.email,
    req.body.telefone,
    req.body.ctps,
    req.body.pis_pasep,
    req.body.empresa,
    req.body.setor,
    req.params.id,
  ];
  const { rows } = await db.query(queryString, params);
  res.status(201).send([{ location: "/collaborators/" + rows[0].id }]);
});

router.delete("/:id", async (req, res, next) => {
  const queryString = "delete from colaboradores where id = $1";
  const params = [req.params.id];
  const { rows } = await db.query(queryString, params);
  res.status(204).send();
});
