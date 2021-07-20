public static void main(String[] s) { 
	for (TestCase testCase : TestCase.values()) { testCase.test(); } }

public static enum TestCase {
    GET_TAG_AT {{
            referenceMap.put(1, ConstantPool.Tag.METHODREF);
            referenceMap.put(2, ConstantPool.Tag.CLASS);
            /* ... other data */ }
        @Override
        void testIndex(int cpi, Object reference) {
            ConstantPool.Tag tagToVerify = CP.getTagAt(cpi);
            ConstantPool.Tag tagToRefer = (ConstantPool.Tag) reference;
            String msg = String.format("Method getTagAt works not as expected"
                + "at CP entry #%d: got CP tag %s, but should be %s",
                cpi, tagToVerify.name(), tagToRefer.name());
            Asserts.assertEquals(tagToVerify, tagToRefer, msg);
        }
    },
    GET_CLASS_REF_INDEX_AT { /* other implementations */ };

    protected final Map<Integer, Object> referenceMap;
    TestCase() { this.referenceMap = new HashMap<>(); }
    abstract void testIndex(int cpi, Object reference);
    public void test() { referenceMap.forEach(this::testIndex); }
}