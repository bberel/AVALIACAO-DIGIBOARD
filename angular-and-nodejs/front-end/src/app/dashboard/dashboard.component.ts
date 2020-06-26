import { Component, OnInit } from '@angular/core';
import { ResumeService } from '../services/resume.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss'],
})
export class DashboardComponent implements OnInit {
  numero_colaboradores = 0;
  cargos = [];
  constructor(public resumeService: ResumeService) {}

  ngOnInit() {
    this.resumeService
      .numberCollaborators()
      .subscribe(({ numero_colaboradores }: any) => {
        return (this.numero_colaboradores = numero_colaboradores);
      });

    this.resumeService.collaboratorsByRoles().subscribe((res: any) => {
      return (this.cargos = res);
    });
  }
}
