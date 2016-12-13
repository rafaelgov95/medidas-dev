/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { AddReuComponent } from './add-reu.component';

describe('AddReuComponent', () => {
  let component: AddReuComponent;
  let fixture: ComponentFixture<AddReuComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddReuComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddReuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
