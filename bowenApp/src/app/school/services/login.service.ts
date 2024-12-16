import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { Login } from '../models/login.model';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import { retry } from 'rxjs/operators';
import Utils from '../../helpers/utils';

@Injectable({
  providedIn: 'root'
})
export class LoginService {


  constructor(private http:HttpClient) { }

  getEmployees(): Observable<Login> {
    return this.http
      .get<Login>(Utils.api_n29 + 'ws.n29e.get.masterdata')
      .pipe(retry(1));
  }

}
