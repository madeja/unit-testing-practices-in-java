private void checkFirstDayOfWorkweekIsValid(CountryInfo info) {
    assertTrue(Weekdays.Companion
    	.getWeekdayIndex(info.getFirstDayOfWorkweek()) > -1);
}

private void checkLengthUnitIsEitherMeterOrFootAndInch(CountryInfo info) {
    assertNotNull(info.getLengthUnits());
}

private void checkForEach(CountryInfo info) {
    checkFirstDayOfWorkweekIsValid(info);
    checkLengthUnitIsEitherMeterOrFootAndInch(info);
}

@Test public void all() throws IOException {
    Map<String, CountryInfo> infos = getAllCountryInfos();
    for(Map.Entry<String,CountryInfo> elem : infos.entrySet()) {
        checkForEach(elem.getValue());
    }
}