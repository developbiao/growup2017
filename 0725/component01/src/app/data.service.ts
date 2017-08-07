import { Injectable } from '@angular/core';

@Injectable()

export class DataService {

  constructor() { }

  cars = [
      'Ford', 'Chevrolet', 'Buick'
  ];

  myData(){
      return 'This is my data, main!';
  }

}
