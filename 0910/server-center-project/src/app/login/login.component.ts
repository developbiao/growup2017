import { Component, OnInit } from '@angular/core';
import { User } from '../user-model';
import { LoginService } from './login.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  constructor(private loginService: LoginService) { }
  users: User[];

  ngOnInit() {
    console.log('Starting initialization user...');
    this.getUsers();

  }

  getUsers(): void {
      this.loginService
          .getUsers()
          .then(users => this.users = users);

  }

}
