import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
//router
import { routing } from './app.routing';
//modules
import { FormModule } from './forms/form.module';
//AppModule
import { AppComponent } from './app.component';
//import component
import{NavBarComponent} from './nav-bar/nav-bar.component';
import{FooterComponent} from './footer/footer.component';
import { PanelPrimaryComponent } from './panel-primary/panel-primary.component';
import { ListMedidasComponent } from './list-medidas/list-medidas.component';

@NgModule({
  declarations: [
    AppComponent,
    NavBarComponent,
    PanelPrimaryComponent,
    FooterComponent,
    ListMedidasComponent
 
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    FormModule,
    routing
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
