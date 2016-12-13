import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
//component
import { AddMedidaComponent } from './add-medida/add-medida.component';
import { AddReuComponent } from './add-medida/add-reu/add-reu.component'
import { AddVitimaComponent } from './add-medida/add-vitima/add-vitima.component'

@NgModule({
  declarations: [
    AddMedidaComponent,
    AddReuComponent,
    AddVitimaComponent
  ],
  imports: [
    CommonModule
  ],
  providers: []

})
export class FormModule { }
