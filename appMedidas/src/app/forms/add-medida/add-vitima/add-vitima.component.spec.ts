/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { AddVitimaComponent } from './add-vitima.component';

describe('AddVitimaComponent', () => {
  let component: AddVitimaComponent;
  let fixture: ComponentFixture<AddVitimaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddVitimaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddVitimaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
