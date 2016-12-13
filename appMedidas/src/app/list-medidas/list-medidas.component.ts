import { Component, OnInit } from '@angular/core';
declare var $: any
@Component({
  selector: 'app-list-medidas',
  templateUrl: './list-medidas.component.html',
  styleUrls: ['./list-medidas.component.css']
})
export class ListMedidasComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    $(document).ready(function() {
    $('select').material_select();
  });
  }

}
