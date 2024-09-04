#include<bits/stdc++.h>
#include<ext/pb_ds/assoc_container.hpp>
#include<ext/pb_ds/tree_policy.hpp>
using namespace std;
using namespace __gnu_pbds;

typedef tree<int , null_type , less<int>, rb_tree_tag, tree_order_statistics_node_update > pbds; //find_by_order() --> it , order_of_key()

#define  int long long
#define ld long double
#define endl "\n"
#define in(arr,n) for(int i = 0; i < n; i++) cin>>arr[i]
#define in1(arr,n) for(int i = 1; i <= n; i++) cin>>arr[i]
#define out(arr,n) for(int i = 0; i < n ; ++i) cout<<arr[i]<<" ";cout<<endl
#define loop(i , s , e ) for(int i=s; i<e; i++)
#define vct vector<int>
#define vctPr vector<pair<int,int>>
#define pb push_back
#define F first
#define S second
// b^-1 % mod = binexp( b , mod - 2 , mod );
const int mod = 1e9 + 7;
bool isPrime(int n){
    for (int i = 2; i * i <= n; ++i){
        if (n % i == 0) return false;
    }
    return true;
}
int power(int x, int y, int md) {
    if( y == 0 ) return 1;
    if( x == 0) return 0;
    int z = 1;
    x = x % md;
    while (y > 0){
        if ((y & 1LL))
            z = (z * x) % md;
        y = (y >> 1LL);
        x = (x * x) % md;
    }
    return z;
}
const int g = 1e6+ 5;
int spf[g];
void sieve(){
    spf[1] = 1;
    for (int i = 2; i < g; i++) spf[i] = i;
    for (int i = 4; i < g; i += 2) spf[i] = 2;
    for (int i = 3; i * i < g; i++) {
        if (spf[i] == i) {
            for (int j = i * i; j < g; j += i){
                if (spf[j] == j) spf[j] = i;
            }
        }
    }
}
vector<int> factors(int x){
    vector<int> ret;
    if(!isPrime(x) ) ret.pb(x);
    while (x != 1) {
        ret.push_back(spf[x]);
        x = x / spf[x];
    }
    ret.pb(1);
    return ret;
}
const int N = 1000000;
int fac[N];
int invFact[N];
void factorial(){
    fac[0] = invFact[0] = 1;
    for (int i = 1; i < N; i++){
        fac[i] = (fac[i - 1] * i) % mod;
        invFact[i] = power(fac[i], mod - 2 , mod );
    }
}
int C(int n, int k) {
    if (k > n || n == 0 ) return 0;
    return fac[n] * invFact[k] % mod * invFact[n - k] % mod;
}
ld binpow(ld b , int p ){
    ld ans  = 1;
    for(; p ; p >>= 1) {
        if(p & 1) ans = ans * b ;
        b = b * b;
    }
    return ans;
}
int modInverse(int a, int M){
    int m = M;
    int y = 0, x = 1;
    if (M == 1) return 0;
    while (a > 1) {
        int q = a / M;
        int t = M;
        M = a % M;
        a = t;
        t = y;
        y = x - q * y;
        x = t;
    }
    if (x < 0) x += m;
    return x;
}
signed main() {
    ios_base::sync_with_stdio(false);
    cin.tie(NULL);
    int n;
    cin >> n;

    int a[n + 1] = {1};
    loop(i , 1 , n + 1 ) cin >> a[i];

    for(int i = 1; i <= n; i++ ) {
        a[i] = (a[i] * a[i - 1]) % mod;
    }

    int t;
    cin >> t;
    while(t--) {

        int l , r , m;
        cin >> l >> r >> m;

        int w = (a[r] * modInverse(a[l - 1] , mod) ) % m ;

        cout << w << endl;
    }
}