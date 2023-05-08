#include<stdio.h>
#include<string.h>
#include<stdlib.h>
#include<limits.h>
int main(){
	char *c=(char*)malloc(100000*sizeof(char));
	gets(c);
	if(strlen(c)==1){
		if(c[0]=='D'){
			printf("1");
		}
		else{
			printf("0");
		}
	}
	else{
	long F[strlen(c)];
	for (long i=0; i<strlen(c); i++){
		F[i]=0;
		}
	for(long i=0;i<strlen(c); i++){
		for (long j=0; j<i; j++){
			if (c[0]=='D'){
				F[0]=1;
			}
			if (c[i]=='D'){
				F[i]=F[j]+1;
			}
		}
	}
	
	int max1=F[0], max2=INT_MIN, a=0;
	for (long i=0;i<strlen(c); i++){
		if (F[i]>max1){
			max1=F[i];
			a=i;
		}
	}
		for(long j=a-1; j>=a-(max1-1); j--){
			F[j]=0;
		}
	for (long i=0;i<strlen(c); i++){
		if (F[i]>max2&&i!=a){
			max2=F[i];
		}
	}
	printf("%d", max1+max2);
		free(c);
	}
}