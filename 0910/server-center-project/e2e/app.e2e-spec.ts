import { ServerCenterProjectPage } from './app.po';

describe('server-center-project App', () => {
  let page: ServerCenterProjectPage;

  beforeEach(() => {
    page = new ServerCenterProjectPage();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!!');
  });
});
