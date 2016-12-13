import { ModuleWithProviders } from '@angular/core';
import { Routes,RouterModule } from '@angular/router';
import { AddMedidaComponent } from './forms/add-medida/add-medida.component';
import { ListMedidasComponent } from './list-medidas/list-medidas.component';
const APP_ROUTES: Routes = [
    { path: 'form', component: AddMedidaComponent },
    { path: 'list', component: ListMedidasComponent }

];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES);