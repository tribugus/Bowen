import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router} from '@angular/router';
import { AuthService } from './auth.service';
@Injectable({
  providedIn: 'root'
})
export class AuthGuard2 implements CanActivate {
  constructor(private authService: AuthService, private router: Router){};
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot):boolean {
     
    let isLoggedIn = this.authService.isAuthenticated();
    if (isLoggedIn){
      this.router.navigate(['/dashboard']);
      return false
    } else {
      return true;
    }
  }
  
}