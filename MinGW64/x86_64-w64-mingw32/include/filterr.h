/**
 * This file has no copyright assigned and is placed in the Public Domain.
 * This file is part of the mingw-w64 runtime package.
 * No warranty is given; refer to the file DISCLAIMER.PD within this package.
 */
#ifndef _FILTERR_H_
#define _FILTERR_H_

#ifndef FACILITY_WINDOWS
#define FACILITY_WINDOWS 0x8
#define FACILITY_ITF 0x4

#define STATUS_SEVERITY_SUCCESS 0x0
#define STATUS_SEVERITY_COFAIL 0x3
#define STATUS_SEVERITY_COERROR 0x2

#define NOT_AN_ERROR ((HRESULT)0x00080000)
#endif

#define FILTER_E_END_OF_CHUNKS ((HRESULT)0x80041700)
#define FILTER_E_NO_MORE_TEXT ((HRESULT)0x80041701)
#define FILTER_E_NO_MORE_VALUES ((HRESULT)0x80041702)
#define FILTER_E_ACCESS ((HRESULT)0x80041703)
#define FILTER_W_MONIKER_CLIPPED ((HRESULT)0x00041704)
#define FILTER_E_NO_TEXT ((HRESULT)0x80041705)
#define FILTER_E_NO_VALUES ((HRESULT)0x80041706)
#define FILTER_E_EMBEDDING_UNAVAILABLE ((HRESULT)0x80041707)
#define FILTER_E_LINK_UNAVAILABLE ((HRESULT)0x80041708)
#define FILTER_S_LAST_TEXT ((HRESULT)0x00041709)
#define FILTER_S_LAST_VALUES ((HRESULT)0x0004170A)
#define FILTER_E_PASSWORD ((HRESULT)0x8004170B)
#define FILTER_E_UNKNOWNFORMAT ((HRESULT)0x8004170C)

#endif