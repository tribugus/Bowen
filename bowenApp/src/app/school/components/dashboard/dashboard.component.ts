import { Component, OnInit } from '@angular/core';
import Swal from'sweetalert2';
import { LoadingService } from '../../services/loading.service';
import { AuthService } from '../../auth/auth.service';
import { Router} from '@angular/router';
import Utils from 'src/app/helpers/utils';
import { getCookie, setCookie } from 'typescript-cookie';


const body = document.getElementsByClassName("example-container");




@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {


  dataMenu = Utils.jsonData("dataMenu");

  panelOpenState = false;

  constructor(private loader: LoadingService,private auth: AuthService,private router: Router) { }

  ngOnInit(): void {

  }



  logout(): void {

    this.loader.bluron(body);
    Swal.fire({
      title: '¿Desea salir de la session?',
      showCloseButton: false,
      showCancelButton: true,
      allowOutsideClick: false,
      focusConfirm: false,
      confirmButtonColor: '#F44336',
      confirmButtonText:
        '<i class="fa fa-check-square"></i> Si',
      cancelButtonColor: '#808080',
      cancelButtonText:
        '<i class="fa fa-close"></i> No',
    }).then((result) => {
      if (result.isConfirmed) {
        this.auth.isLoggedIn = false;
        Utils.removeSessions();
        this.router.navigate(['/login']);
      }
      else{
      }
      this.loader.bluroff(body);
    });



  }

  panelCokie(e:Number): void{
    setCookie('config_secciones_sequence', e.toString());
  }
  setCockie(e:Number): boolean{
    const a = getCookie('config_secciones_sequence') != undefined ? getCookie('config_secciones_sequence') : 0;
    if(e==a)
      return true;
    return false;
  };

}
