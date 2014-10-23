# define gfix service
namespace php GFIX
namespace py gfix

/**
 * Type and Structs
 */

typedef i64 Timespamp
typedef map<i16, double> Tda

struct Tp {
    1: required i16 id,
    2: required string name,
    3: required double lat,
}

struct Tr {
    1: required i16 id,
    2: required string name,
    3: required Timespamp created,
}

struct TrQuery {
    1: required list<i16> tr_ids
}

/**
 * Exceptions
 */

enum GFIXErrorCode {
    UNKNOW_ERROR
}

exception GFIXUserException {
    1: required GFIXErrorCode error_code,
    2: required string error_name,
    3: required string message,
}

exception GFIXSystemException {
    1: required GFIXErrorCode error_code,
    2: required string error_name,
    3: required string message,
}

exception GFIXUnknowException {
    1: required GFIXErrorCode error_code,
    2: required string error_name,
    3: required string message,
}

/**
 * Services
 */
service GfixService {
    bool ping()
        throws (1: GFIXUserException user_exception,
                2: GFIXSystemException system_exception,
                3: GFIXUnknowException unkown_exception),

    Tp get_tp(1: i16 tp_id)
        throws (1: GFIXUserException user_exception,
                2: GFIXSystemException system_exception,
                3: GFIXUnknowException unkown_exception),

    map<string, i16> mcount_tp(1: list<string> tp_name)
        throws (1: GFIXUserException user_exception,
                2: GFIXSystemException system_exception,
                3: GFIXUnknowException unkown_exception),

    list<Tr> query_tr(1: TrQuery query_struct)
        throws (1: GFIXUserException user_exception,
                2: GFIXSystemException system_exception,
                3: GFIXUnknowException unkown_exception),

    list<Tda> query_da(1: TrQuery query_struct)
        throws (1: GFIXUserException user_exception,
                2: GFIXSystemException system_exception,
                3: GFIXUnknowException unkown_exception),
}
