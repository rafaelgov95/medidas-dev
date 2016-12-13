import { Component, AfterViewInit, Directive} from '@angular/core';
declare var $: any
@Component({
  selector: 'app-add-reu',
  templateUrl: './add-reu.component.html',
  styleUrls: ['./add-reu.component.css']
})
export class AddReuComponent implements AfterViewInit {
Users = [{name:"Rafael Viana"},{name:"Higor"}]
  constructor() { }

 public ngAfterViewInit() {
     $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  }

}
