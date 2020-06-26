import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';

@Injectable({ providedIn: 'root' })
export class ResumeService {
  constructor(private httpClient: HttpClient) {}

  numberCollaborators() {
    return this.httpClient.get('http://localhost:3000/resume/numberofcollaborators');
  }

  collaboratorsByRoles() {
    return this.httpClient.get('http://localhost:3000/resume/collaboratorsbyroles');
  }
}
