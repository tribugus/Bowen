import { Component, OnInit } from '@angular/core';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { catchError } from 'rxjs/operators';
import { LoginService } from '../../services/login.service';
import Utils from '../../../helpers/utils';
import {HttpClient, HttpHeaders} from "@angular/common/http";

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

 
  
  constructor(public dialog: MatDialog,private login: LoginService,private http: HttpClient) { }

  

  ngOnInit(): void {


  }

  getHeroes(): void {

  
    /* var a = this.login.getEmployees();
    a.subscribe(data => 
    {
      console.log(data);
    }); */
    this.fetchDataAsPromise()
    .then((data) => {
      //console.log(JSON.stringify(data));
      console.log(data);
    })
    .catch((error) => {
      //console.log("Promise rejected with " + JSON.stringify(error));
    });


    
  }

  fetchDataAsPromise() {
    return this.http.get(Utils.api + 'ws.n29e.get.masterdata').toPromise();
  }
  


  // Error handling
  /* handleError(error: any) {
    let errorMessage = '';
    if (error.error instanceof ErrorEvent) {
      // Get client-side error
      errorMessage = error.error.message;
    } else {
      // Get server-side error
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    window.alert(errorMessage);
    return throwError(() => {
      return errorMessage;
    });
  } */

  openDialog(): void {
    
    /* const dialogRef = this.dialog.open(DialogOverviewExampleDialog, {
      width: '250px',
    }); */

    /* dialogRef.afterClosed().subscribe(result => {
      console.log('The dialog was closed');
    }); */
  }

}