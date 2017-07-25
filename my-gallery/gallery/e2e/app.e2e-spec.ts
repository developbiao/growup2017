import { GalleryPage } from './app.po';

describe('gallery App', () => {
  let page: GalleryPage;

  beforeEach(() => {
    page = new GalleryPage();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!!');
  });
});
