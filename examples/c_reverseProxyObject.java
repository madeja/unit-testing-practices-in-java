enum ParkMethod {
    park() {
        void park() {
            LockSupport.park();
        }
        Thread.State parkedState() { return Thread.State.WAITING; }
    },
    parkNanos() {
        void park(long millis) {
            LockSupport.parkNanos(MILLISECONDS.toNanos(millis));
        }
    }
}

public void testParkAfterInterrupt(final ParkMethod parkMethod) {
    // verification implementation (asserts, exception catch, etc.)
}

public void testParkAfterInterrupt_park() {
    testParkAfterInterrupt(ParkMethod.park);
}

public void testParkAfterInterrupt_parkNanos() {
    testParkAfterInterrupt(ParkMethod.parkNanos);
}