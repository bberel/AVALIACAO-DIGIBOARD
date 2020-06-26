import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { CollaboratorsService } from 'src/app/services/collaborators.service';
import { RolesService } from 'src/app/services/roles.service';
import { OccupationsService } from 'src/app/services/occupations.service';
import { CompaniesService } from 'src/app/services/companies.service';
import { DepartmentsService } from 'src/app/services/departments.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-employees-form',
  templateUrl: './form.component.html',
  styleUrls: [],
})
export class EmployeesFormComponent implements OnInit {
  id = null;
  cargos = [];
  funcoes = [];
  empresas = [{ nome: 'c', value: 'c' }];
  setores = [{ nome: 'd', value: 'd' }];
  form = this.formBuilder.group({
    cpf: [
      null,
      [
        Validators.required,
        Validators.maxLength(11),
        Validators.pattern(/^[0-9]{11}$/),
      ],
    ],
    nome_completo: [null, [Validators.required, Validators.maxLength(200)]],
    sexo: [null, [Validators.required]],
    nome_mae: [null, [Validators.required]],
    nacionalidade: [null, [Validators.required]],
    data_nascimento: [
      null,
      [
        Validators.required,
        Validators.pattern(/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/),
      ],
    ],
    cargo: [null, [Validators.required]],
    funcao: [null, [Validators.required]],
    remuneracao: [null, [Validators.required]],
    rg: [null, [Validators.required]],
    orgao_emissor: [null, [Validators.required, Validators.maxLength(50)]],
    email: [null, [Validators.required, Validators.email]],
    telefone: [
      null,
      [
        Validators.required,
        Validators.pattern(/^[0-9]{2,3}\s[0-9]{4,5}-[0-9]{4}$/),
      ],
    ],
    ctps: null,
    pis_pasep: null,
    empresa: [null, [Validators.required]],
    setor: [null, [Validators.required]],
  });

  constructor(
    private formBuilder: FormBuilder,
    private _snackBar: MatSnackBar,
    private route: ActivatedRoute,
    public collaboratorsService: CollaboratorsService,
    public rolesService: RolesService,
    public occupationsService: OccupationsService,
    public companiesService: CompaniesService,
    public departmentsService: DepartmentsService
  ) {}

  ngOnInit() {
    this.route.params.subscribe((params: any) => {
      this.id = params['id'];
      if (this.id) {
        this.getCollaborator(this.id);
      }
    });

    this.rolesService
      .getList()
      .subscribe((res: Array<any>) => (this.cargos = res));

    this.form.controls.cargo.valueChanges.subscribe((id) => {
      if (!!id) {
        this.occupationsService
          .getList(id)
          .subscribe((res: Array<any>) => (this.funcoes = res));
      }
    });

    this.companiesService
      .getList()
      .subscribe((res: Array<any>) => (this.empresas = res));

    this.departmentsService
      .getList()
      .subscribe((res: Array<any>) => (this.setores = res));
  }

  getCollaborator(id) {
    this.collaboratorsService.getById(id).subscribe((res: any) => {
      console.log(res);
      this.form.patchValue({
        cpf: res.cpf,
        nome_completo: res.nome_completo,
        sexo: res.sexo,
        nome_mae: res.nome_mae,
        nacionalidade: res.nacionalidade,
        data_nascimento: res.data_nascimento,
        cargo: res.cargo_id,
        funcao: res.funcao_id,
        remuneracao: res.remuneracao,
        rg: res.rg,
        orgao_emissor: res.orgao_emissor,
        email: res.email,
        telefone: res.telefone,
        ctps: res.ctps,
        pis_pasep: res.pis_pasep,
        empresa: res.empresa_id,
        setor: res.setor_id,
      });
    });
  }

  openSnackBar(message: string, action: string) {
    this._snackBar.open(message, action, {
      duration: 2000,
    });
  }

  onSubmit = () => {
    if (this.form.valid) {
      if (!!this.id) {
        this.collaboratorsService
          .update(this.id, this.form.value)
          .subscribe((response) => {
            this.openSnackBar('Salvo', 'Ok!');
          });
      } else {
        this.collaboratorsService.add(this.form.value).subscribe((response) => {
          this.form.reset();
          this.openSnackBar('Salvo', 'Ok!');
        });
      }
    }
  };
}
