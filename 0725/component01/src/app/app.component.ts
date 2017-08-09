import { Component } from '@angular/core';
import { trigger, state, style, transition, animate, keyframes } from '@angular/animations';

@Component({
  selector: 'app-root',
  template: `
     <p [@myAwesomeAnimation]='state' (click)="animateMe()">I will animate</p> 
  `,
  styles: [`
      p{
          width: 200px;
          background:lightgreen;
          text-align: center;
          margin: 100px auto;
          padding: 20px;
          font-size: 1.5em;
      }
  `],
    animations: [
        trigger('myAwesomeAnimation', [
            state('small', style({
                transform: 'scale(1)',
            })),
            state('large', style({
                transform: 'scale(1.2)',
            })),
            transition('small => large', animate('300ms ease-in', keyframes([
                style({opacity: 0, transform: 'translateY(-75%)', offset: 0}),
            ]))),
        ]),
    ]

})
export class AppComponent {
    state: string = 'small';
    animateMe(){
        this.state = (this.state === 'small' ? 'large' : 'small');
    }
}
