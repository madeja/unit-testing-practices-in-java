public void testEcho() { /* test page content */ }

public void testA4JRedirect(){
    client.click("redirect");
    assertEquals("/pages/echo.xhtml", server.getCurrentViewID());
    testEcho(); // make sure I can continue
}