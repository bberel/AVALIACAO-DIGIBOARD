import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  NavItens = [
    {
      path: '/dashboard',
      title: 'Painel'
    },
    {
      path: '/collaborators/list',
      title: 'Lista de Colaboradores'
    },
    {
      path: '/collaborators/add',
      title: 'Adicionar Colaborador'
    }
  ]
}
