import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot,
    NavigationEnd, Router} from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from './auth.service';
import Utils from 'src/app/helpers/utils';

@Injectable({
  providedIn: 'root'
})
export class RouteGuard implements CanActivate {
  constructor(private authService: AuthService, private router: Router){

  };
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot):boolean {

    let vamos = next.routeConfig?.path;
    const dataUrls = Utils.jsonData("dataUrls");
    var index = dataUrls.indexOf(vamos);
    
    let isLoggedIn = 1;
    if (index >= 0){
      return true
    } else {
      this.router.navigate(['/dashboard']);
      return false;
    }
  }
  
}