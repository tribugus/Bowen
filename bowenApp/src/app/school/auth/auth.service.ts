import { Injectable } from '@angular/core';
@Injectable({
  providedIn: 'root'
})
export class AuthService {

  session_user = sessionStorage.getItem("_nghost-upu-c16");
  isLoggedIn = false;

  constructor() {
    if(this.session_user!=null){
      this.isLoggedIn = true;
    }
  }
  isAuthenticated(){
    return this.isLoggedIn;
  }
}