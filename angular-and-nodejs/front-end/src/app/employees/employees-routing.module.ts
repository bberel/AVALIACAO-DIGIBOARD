import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { EmployeesListComponent } from './components/list/list.component';
import { EmployeesFormComponent } from './components/form/form.component';

const routes: Routes = [
  {
    path: 'list',
    component: EmployeesListComponent,
  },
  {
    path: 'add',
    component: EmployeesFormComponent,
  },
  {
    path: 'edit/:id',
    component: EmployeesFormComponent,
  },
  {
    path: '',
    redirectTo: 'list',
    pathMatch: 'full',
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class EmployeesRoutingModule {}
