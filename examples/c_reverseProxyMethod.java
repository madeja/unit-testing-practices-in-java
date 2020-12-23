protected void doTest() {
    // use test name for test evaluation
    myFixture.testHighlighting(true, false, true, getTestName(false) + ".java");
}

public void testTryInAnonymous() { doTest(); }
public void testNullableAnonymousMethod() { doTest(); }
public void testNullableAnonymousParameter() { doTest(); }