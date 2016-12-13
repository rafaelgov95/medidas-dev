import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-add-vitima',
  templateUrl: './add-vitima.component.html',
  styleUrls: ['./add-vitima.component.css']
})
export class AddVitimaComponent implements OnInit {
Users = [{name:"Rafael Viana"},{name:"Higor"}]
 
 autocompl = [{name:"Rafael Viana"},{name:"Higor"}]

  constructor() { }

  ngOnInit() {
  }

}
