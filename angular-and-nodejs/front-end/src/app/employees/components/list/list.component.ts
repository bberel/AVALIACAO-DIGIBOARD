import { Component, OnInit, ViewChild } from '@angular/core';
import { CollaboratorsService } from 'src/app/services/collaborators.service';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { FormBuilder, Validators } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';

@Component({
  selector: 'app-employees-list',
  templateUrl: './list.component.html',
  styleUrls: [],
})
export class EmployeesListComponent implements OnInit {
  collaborators = new MatTableDataSource([]);
  displayedColumns: string[] = [
    'cpf',
    'nome_completo',
    'contact',
    'empresa',
    'setor',
    'cargo',
    'edit',
    'delete',
  ];
  filtro = this.formBuilder.group({
    nome: null,
    telefone: [null, [Validators.pattern(/^[0-9]{2,3}\s[0-9]{4,5}-[0-9]{4}$/)]],
    empresa: null,
    setor: null,
    email: [null, [Validators.email]],
    cargo: null,
  });
  @ViewChild(MatSort, { static: true }) sort: MatSort;

  constructor(
    private formBuilder: FormBuilder,
    private _snackBar: MatSnackBar,
    public collaboratorsService: CollaboratorsService
  ) {}

  ngOnInit() {
    this.getData();
  }

  getData(filtro = null) {
    this.collaboratorsService.getList(filtro).subscribe((res: Array<any>) => {
      this.collaborators.data = res;
      this.collaborators.sort = this.sort;
    });
  }

  deleteCollaborator(id) {
    this.collaboratorsService.del(id).subscribe(() => this.getData());
  }

  onFilter() {
    if (this.filtro.valid) {
      this.getData(JSON.stringify(this.filtro.value));
    }
  }

  naoFinalizado() {
    this._snackBar.open('Não Finalizado', '', {
      duration: 2000,
    });
  }

  limparCampo(campo) {
    this.filtro.controls[campo].setValue(null);
  }
}
