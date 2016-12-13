import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent implements OnInit {
  aba : string = 'Lista'
  // console.log(aba);
  urls=[
    {urlName:'LISTA ' ,url:'list'},

     {urlName:'FORMULARIO', url:'form'},
  ];

  constructor() { }

  ngOnInit() {
  }

}
