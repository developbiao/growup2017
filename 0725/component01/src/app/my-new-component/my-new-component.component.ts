import { Component, OnInit } from '@angular/core';
import { DataService } from "../data.service";

@Component({
  selector: 'app-my-new-component',
  templateUrl: './my-new-component.component.html',
  styleUrls: ['./my-new-component.component.css']
})
export class MyNewComponentComponent implements OnInit {

    constructor(public dataService:DataService){

    }

    ngOnInit(){
        console.log(this.dataService);
    }

    logoImage = "https://www.starbucks.com.cn/_themes/starbucks/img/mooncake2017/box1.png";
    something = "What is a angular4?";
    is_switch = false;


  // array
  myArr = ["Guitar", "Piano", "Harmonica"];
  status = "true";

  someProperty:string = this.dataService.myData();

  changeImage(event)
  {
      if(this.is_switch)
      {
          this.logoImage = "https://www.starbucks.com.cn/_themes/starbucks/img/mooncake2017/box1.png";
          this.is_switch = false;
      }
      else
      {
          this.logoImage = "http://www.starbucks.com.hk/media/BSM-550x420-02_tcm65-31096_w1024_n.png";
          this.is_switch = true;
      }
      console.log("execute event...");
  }

  animateMe(){

  }

}
