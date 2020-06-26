import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { EmployeesListComponent } from './components/list/list.component';
import { EmployeesRoutingModule } from './employees-routing.module';
import { EmployeesFormComponent } from './components/form/form.component';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatButtonModule } from '@angular/material/button';
import { MatRadioModule } from '@angular/material/radio';
import { MatSelectModule } from '@angular/material/select';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { MatDividerModule } from '@angular/material/divider';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { MatTableModule } from '@angular/material/table';
import { MatSortModule } from '@angular/material/sort';
import { MatCardModule } from '@angular/material/card';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    EmployeesRoutingModule,
    MatIconModule,
    MatInputModule,
    MatButtonModule,
    MatRadioModule,
    MatSelectModule,
    MatDividerModule,
    MatSnackBarModule,
    MatTableModule,
    MatSortModule,
    MatCardModule,
  ],
  declarations: [EmployeesListComponent, EmployeesFormComponent],
  exports: [EmployeesListComponent, EmployeesFormComponent],
  providers: [],
})
export class EmployeesModule {}
