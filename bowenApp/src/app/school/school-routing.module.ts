import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { InicioComponent } from './components/inicio/inicio.component';
import { SeccionesComponent } from './components/secciones/secciones.component';
import { ModulosComponent } from './components/modulos/modulos.component';
import { RouteGuard } from './auth/route.guard';
import { AuthGuard } from './auth/auth.guard';
import { AuthGuard2 } from './auth/auth.guard2';


const routes: Routes = [

  { path:'login', component: LoginComponent,canActivate:[AuthGuard2] },
  
  { 
    path: 'dashboard', 
    component: DashboardComponent,canActivate:[AuthGuard],
    children: [
      { path: '', component: InicioComponent },
      { path: 'secciones', component: SeccionesComponent,canActivate:[RouteGuard]  },
      { path: 'modulos', component: ModulosComponent,canActivate:[RouteGuard]  },
    ]

  },
 

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SchoolRoutingModule { }
