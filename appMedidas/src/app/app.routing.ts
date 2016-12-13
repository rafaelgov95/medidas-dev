import { ModuleWithProviders } from '@angular/core';
import { Routes,RouterModule } from '@angular/router';
import { AddMedidaComponent } from './forms/add-medida/add-medida.component';
const APP_ROUTES: Routes = [
    { path: 'form', component: AddMedidaComponent }


];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES);