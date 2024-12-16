import { NgModule } from '@angular/core';
import { MaterialModule } from '../material/material.module';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';


import { MatSliderModule } from '@angular/material/slider';


import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';


import { SchoolRoutingModule } from './school-routing.module';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { HeaderComponent } from './components/resources/header/header.component';
import { FooterComponent } from './components/resources/footer/footer.component';
import { InicioComponent } from './components/inicio/inicio.component';
import { SeccionesComponent } from './components/secciones/secciones.component';
import { ModulosComponent } from './components/modulos/modulos.component';

@NgModule({
  declarations: [
    LoginComponent,
    DashboardComponent,
    HeaderComponent,
    FooterComponent,
    InicioComponent,
    SeccionesComponent,
    ModulosComponent,
  ],
  imports: [
    MatSliderModule,
    CommonModule,
    SchoolRoutingModule,
    MaterialModule,
    HttpClientModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot({
      positionClass: 'toast-top-center',
      preventDuplicates: true,
    }),
    
  ]
})
export class SchoolModule { }
