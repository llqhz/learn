#ifndef SPL_ARRAY_H
#define SPL_ARRAY_H

#include <iostream>
using namespace std;

template <typename T>
class SplArray
{
    protected:
        T *pArray;
        int capacity;
        int len;

    public:
        /**
         * 构造函数
         */
        SplArray(int capacity = 0);
        
        /**
         * 析构函数
         */
        ~SplArray();
       
        /**
         * 清空顺序表
         */
        void clear();

        /**
         * 是否为空
         */
        bool isEmpty();

        /**
         * 顺序表长度
         */
        int length();

        /**
         * 获取顺序表指定位置元素  传递T类型的指针
         */
        bool get(int i, T *elem);

        /**
         * 获取元素下标  传递T类型的指针
         */
        int locate(T *elem);

        /**
         * 获取元素前驱  传递T类型的指针
         */
        bool prev(T *current, T *previous);

        /**
         * 获取元素前驱  传递T类型的指针
         */
        bool next(T *current, T *next);

        /**
         * 在position位置元素之前插入元素  传递T类型的指针
         */
        bool insert(int position, T *elem);

        /**
         * 删除元素 
         */
        bool remove(int position);

        /**
         * 遍历顺序线性表
         */
        void traverse();
};

template <typename T>
SplArray<T>::SplArray(int capacity)
{
    this->capacity = capacity;
    this->pArray = new T[capacity];
    this->len = 0;
}

template <typename T>
SplArray<T>::~SplArray()
{
    this->len = 0;
    delete [] this->pArray;
    this->pArray = nullptr;
}

template <typename T>
void SplArray<T>::clear()
{
    this->len = 0;
}

template <typename T>
bool SplArray<T>::isEmpty()
{
    return this->len == 0 ? true : false;
}

template <typename T>
int SplArray<T>::length()
{
    return this->len;
}

template <typename T>
bool SplArray<T>::get(int i, T *elem)
{
    if (i <= 0 || i > this->capacity) {
        return false;
    }
    *elem = this->pArray[i];
    return true;
}

template <typename T>
int SplArray<T>::locate(T *elem)
{
    for (int i = 0; i < this->len; i++) {
        if (*elem == this->pArray[i]) {
            return i;
        }
    }
    return -1;
}

template <typename T>
bool SplArray<T>::prev(T *current, T *previous)
{
    int i = this->locate(current);
    if (i <= 0) {
        return false;
    }
    *previous = this->pArray[i-1];
    return true;
}

template <typename T>
bool SplArray<T>::next(T *current, T *next)
{
    int i = this->locate(current);
    if (i == -1 || i == (this->len-1)) {
        return false;
    }
    *next = this->pArray[i+1];
    return true;
}

template <typename T>
void SplArray<T>::traverse()
{
    for (int i = 0; i < this->len; i++)
    {
        cout << this->pArray[i] << endl;
    }
}


/**
 * 在元素之前插入元素  传递T类型的指针
 */
template <typename T>
bool SplArray<T>::insert(int position, T *elem)
{
    cout << position << endl;
    if (position == this->capacity || position < 0 || position > this->len) {
        cout << "return false:" << this->capacity << endl;
        return false;
    }
    for (int i = this->len; i >= position; i--)
    {
        this->pArray[i] = this->pArray[i-1];
    }
    this->pArray[position] = *elem;
    this->len++;
    return true;
}

/**
 * 删除元素 
 */
template <typename T>
bool SplArray<T>::remove(int position)
{
    if (position < 0 || position >= this->len) {
        return false;
    }
    for (int i = position + 1; i < this->len; i++)
    {
        this->pArray[i-1] = this->pArray[i];
    }
    this->len--;
    return true;
}


#endif