public static void main(String[] args) throws IOException {
    TestCase[]  tests = createTests();
    for (TestCase t : tests) { t.test(); }
}

private static abstract class TestCase {
    abstract void testRead(ImageInputStream iis) throws IOException;
	public void test() { /* real testing of testRead(iis) call */ }
}

private static TestCase[] createTests() {
    return new TestCase[]{
        new TestCase() {
            @Override void testRead(ImageInputStream iis) throws IOException { iis.readInt(); }
        },
        new TestCase() { /* other implementations */ }
    };
}