import { Component01Page } from './app.po';

describe('component01 App', () => {
  let page: Component01Page;

  beforeEach(() => {
    page = new Component01Page();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!!');
  });
});
