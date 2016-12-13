import { Component, OnInit } from '@angular/core';
declare var $: any
@Component({
  selector: 'app-add-medida',
  templateUrl: './add-medida.component.html',
  styleUrls: ['./add-medida.component.css']
})
export class AddMedidaComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    $(document).ready(function() {
    $('select').material_select();
  }  );
  }
ngDestroy(){
   $('select').material_select('destroy');
            
}
}
