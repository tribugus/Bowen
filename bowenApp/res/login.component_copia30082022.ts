import { Component, OnInit } from '@angular/core';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { catchError } from 'rxjs/operators';
import { LoginService } from '../../services/login.service';
import Utils from '../../../helpers/utils';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import { LoadingService } from '../../services/loading.service';
import { Router} from '@angular/router';

import { ToastrService } from 'ngx-toastr';


interface Course {
  description: string;
  courseListIcon:string;
  iconUrl:string;
  longDescription:string;
  url:string;
}

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loading$ = this.loader.loading$;
  user:string="";
  password:string="";

 
  
  constructor(public dialog: MatDialog,private login: LoginService,
    private http: HttpClient,public loader: LoadingService, private router: Router,
    private toastr: ToastrService) { }

  

  ngOnInit(): void {


  }



  loginUser(): void {

    if(this.user==""||this.password==""){
      this.toastr.error('Complete los campos','', { timeOut: 3000, });
      return;
    }
    this.loader.show();
    //this.toastr.success('Hello world!', 'Toastr fun!');
    //this.toastr.error('Loading . . .','', { timeOut: 3000, });
    //this.router.navigate(['/dashboard']);
    this.LoginPromise().then((data:any) => {


      this.router.navigate(['/dashboard']);

      this.toastr.success(data.message+', bienvenido '+data.data.usuario.nombres.toLowerCase(),'', { timeOut: 3000, });
      setTimeout(()=>{
        this.loader.hide();
      }, 3000);
    
    }).catch((e) => {
      if(e.status==500)
        this.toastr.error('Error en el sistema, contacte al administrador','', { timeOut: 3000, });
      
      if(e.status==401)
        this.toastr.error(e.error.message,'', { timeOut: 3000, });

      this.loader.hide();
      this.user = "";
      this.password = "";
    });
    
  }
  LoginPromise() {
    const data = {};
    return this.http.post(Utils.api_intra + 'ws.login.app?codigo='+this.user+'&password='+this.password,
    data).toPromise();
  }
  





  cambiar(event:any,tipe:string): void {
    if(tipe=="user")
      this.user = event.target.value;
    if(tipe=="password")
      this.password = event.target.value.trim();
  }

  addToKeywords(): void{
    this.loginUser();
  }


  

}