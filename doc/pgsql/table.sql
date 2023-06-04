
CREATE TABLE base_currency (
    id           INTEGER   NOT NULL PRIMARY KEY,
    title        TEXT          NULL,
    code         TEXT      NOT NULL UNIQUE,
    symbol       TEXT          NULL,
    icon         TEXT          NULL,
    precision    INTEGER   NOT NULL,
    enable_time  TIMESTAMP     NULL,
    disable_time TIMESTAMP     NULL,
    ranking      INTEGER   NOT NULL
);

CREATE TABLE base_wallet (
    id          INTEGER          NOT NULL PRIMARY KEY,
    member_id   INTEGER          NOT NULL,
    currency_id INTEGER          NOT NULL,
    frozen      DOUBLE PRECISION NOT NULL,
    balance     DOUBLE PRECISION NOT NULL
);

CREATE TABLE base_wallet_log (
    id          INTEGER          NOT NULL PRIMARY KEY,
    wallet_id   INTEGER          NOT NULL,
    the_date    DATE             NOT NULL,
    type        INTEGER          NOT NULL, -- options: wallet-log-type
    amount      DOUBLE PRECISION NOT NULL,
    balance     DOUBLE PRECISION NOT NULL,
    target_id   INTEGER              NULL,
    remark      TEXT                 NULL,
    snapshot    TEXT                 NULL,
    create_time TIMESTAMP        NOT NULL
);

CREATE TABLE base_frozen_log (
    id          INTEGER          NOT NULL PRIMARY KEY,
    wallet_id   INTEGER          NOT NULL,
    the_date    DATE             NOT NULL,
    type        INTEGER          NOT NULL, -- options: wallet-log-type
    amount      DOUBLE PRECISION NOT NULL,
    target_id   INTEGER              NULL,
    remark      TEXT                 NULL,
    snapshot    TEXT                 NULL,
    create_time TIMESTAMP        NOT NULL
);

