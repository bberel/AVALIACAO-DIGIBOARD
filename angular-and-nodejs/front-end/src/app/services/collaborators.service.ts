import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';

@Injectable({ providedIn: 'root' })
export class CollaboratorsService {
  constructor(private httpClient: HttpClient) {}

  getList(filtro = null) {
    return this.httpClient.get('http://localhost:3000/collaborators', {
      params: { filtro },
    });
  }

  getById(id) {
    return this.httpClient.get(`http://localhost:3000/collaborators/${id}`);
  }

  add(params) {
    return this.httpClient.post('http://localhost:3000/collaborators', params);
  }

  update(id, params) {
    return this.httpClient.put(
      `http://localhost:3000/collaborators/${id}`,
      params
    );
  }

  del(id) {
    return this.httpClient.delete(`http://localhost:3000/collaborators/${id}`);
  }
}
