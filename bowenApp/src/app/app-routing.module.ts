import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { InicioComponent } from './school/components/inicio/inicio.component';


const routes: Routes = [

  { path: '**',   redirectTo: '/login', pathMatch: 'full' },

];




@NgModule({
  imports: [RouterModule.forRoot(routes,{ useHash: false })],
  exports: [RouterModule]
})




export class AppRoutingModule { }
