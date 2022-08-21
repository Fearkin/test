
# How to run

cd public/ && php -S localhost:8000

# To get current time in unix format

{"jsonrpc": "2.0", "method": "gettime", "params": {"format": "unix"}, "id": 1}

# To get current time in MySQL Datetime

{"jsonrpc": "2.0", "method": "gettime", "params": {"format": "mysql"}, "id": 1}
