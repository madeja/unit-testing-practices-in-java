public static void main(String[] args) { new SpiTest(); }

public SpiTest() { // constructor
    ServiceRegistry registry = IIORegistry.getDefaultInstance();
    Iterator readers = registry.getServiceProviders(ImageReaderSpi.class, false);
    while (readers.hasNext()) {
        ImageReaderSpi rspi = (ImageReaderSpi)readers.next();
        System.out.println("*** Testing " + rspi.getClass().getName());
        testSpi(rspi);
    } // ... other tests
}

private void testSpi(IIOServiceProvider spi) { /* test case code */ }