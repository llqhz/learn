#include "SplQueue.h"
#include <iostream>
using namespace std;

/**
 * 实现环形队列具体的每个方法
 * 只有当iHead和iTail>=capacity时，才需要进行position更新处理
 */

/**
 * 构造函数：创建队列
 */
SplQueue::SplQueue(int capacity)
{
    // 指定容量
    this->capacity = capacity;

    // 记录头尾位置
    this->iHead = 0;
    this->iTail = 0;

    // 指定长度
    this->len = 0;

    // 分配元素内存
    this->pQueue = new int[capacity];

}


/**
 * 析构函数: 回收内存
 */
SplQueue::~SplQueue()
{
    delete []this->pQueue;
    this->pQueue = nullptr;
}

/**
 * 清空队列(初始化为0)
 */
void SplQueue::clearQueue()
{
    // 记录头尾位置
    this->iHead = 0;
    this->iTail = 0;

    // 指定长度
    this->len = 0;
}

/**
 * 队列是否为空
 */
bool SplQueue::isEmpty()
{
    return this->len == 0 ? true : false;
}

/**
 * 队列是否已满
 */
bool SplQueue::isFull()
{
    return this->len == this->capacity ? true : false;
}


/**
 * 获取队列长度
 */
int SplQueue::length()
{
    return this->len;
}


/**
 * 入队
 */
bool SplQueue::enQueue(int element)
{
    if (this->isFull())
    {
        return false;
    }
    
    // 将元素存入队列尾部指针位置，并将尾部指针向尾部方向再移一位
    this->pQueue[this->iTail] = element;
    this->iTail++;
    // 当队列位置循环变化时，自动更新加一圈
    if (this->iTail == this->capacity)
    {
        this->iTail = 0;
    }
    this->len++;
    return true;
}

/**
 * 出队, 通过引用获取返回元素
 */
bool SplQueue::deQueue(int &element)
{
    if (this->isEmpty())
    {
        return false;
    }
    
    // 将元素头部返回，并将头部指针向尾部方向退(靠近)一位
    element = this->pQueue[this->iHead];
    this->iHead++;
    if (this->iHead == this->capacity)
    {
       this->iHead = 0;
    }
    this->len--;
    return true;
}

/**
 * 遍历队列
 * 从队列头部遍历
 */
void SplQueue::traverse()
{
    int pITail, element, position;
    if (this->iTail <= this->iHead)
    {
        pITail = this->iTail + this->capacity;
    } else {
        pITail = this->iTail;
    }
    
    cout << "traverse start: (iHead,iTail,pITail) => (";
    cout << this->iHead << ",";
    cout << this->iTail << ",";
    cout << pITail << ")" << endl;
    for (int i = this->iHead; i < pITail; i++)
    {
        position = i % this->capacity;
        element = this->pQueue[position];
        cout << element << endl;
        cout << "前面还有 " << i - this->iHead << " 人" << endl;
    }
    cout << "traverse end" << endl;
}





