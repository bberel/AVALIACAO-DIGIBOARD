import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';

@Injectable({ providedIn: 'root' })
export class DepartmentsService {
  constructor(private httpClient: HttpClient) {}

  getList() {
    return this.httpClient.get('http://localhost:3000/departments');
  }
}
